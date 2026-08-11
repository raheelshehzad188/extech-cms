<?php

namespace App\Http\Controllers;

use App\Mail\QuoteRequestMail;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(): View
    {
        $settings = SiteSetting::current();
        $home = $settings->homeContent();

        return view($settings->homeView(), [
            'settings' => $settings,
            'home' => $home,
            'services' => Service::query()->where('is_published', true)->orderBy('sort_order')->take(6)->get(),
            'pricingPlans' => PricingPlan::query()->where('is_published', true)->orderBy('sort_order')->take(6)->get(),
            'brands' => Brand::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'team' => TeamMember::query()->where('is_published', true)->orderBy('sort_order')->take(8)->get(),
            'projects' => Project::query()->where('is_published', true)->orderBy('sort_order')->take(6)->get(),
            'posts' => Post::query()->where('is_published', true)->orderByDesc('published_at')->take(6)->get(),
            'faqs' => Faq::query()->where('is_published', true)->orderBy('sort_order')->take(6)->get(),
            'seo' => $settings,
        ]);
    }

    public function about(): View
    {
        $page = Page::query()->where('slug', 'about')->first()
            ?? new Page([
                'title' => 'About Us',
                'breadcrumb_title' => 'About Us',
                'content' => '',
                'template' => 'about',
                'is_published' => true,
            ]);

        return view('frontend.pages.about', [
            'page' => $page,
            'team' => TeamMember::query()->where('is_published', true)->orderBy('sort_order')->take(4)->get(),
            'seo' => $page->exists ? $page : SiteSetting::current(),
        ]);
    }

    public function contact(): View
    {
        $page = Page::query()->where('slug', 'contact')->where('is_published', true)->first()
            ?? new Page([
                'title' => 'Contact Us',
                'breadcrumb_title' => 'Contact Us',
                'content' => 'Nullam varius, erat quis iaculis dictum, eros urna varius eros, ut blandit felis odio in turpis. Quisque rhoncus, eros in auctor ultrices,',
                'template' => 'contact',
                'sections' => [
                    'form_title' => 'Ready to Get Started?',
                    'phone_label' => 'Call Us 7/24',
                    'email_label' => 'Make a Quote',
                    'location_label' => 'Location',
                    'video_url' => 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I',
                ],
            ]);

        return view('frontend.pages.contact', [
            'page' => $page,
            'seo' => $page->exists ? $page : SiteSetting::current(),
        ]);
    }

    public function services(): View
    {
        return view('frontend.services.index', [
            'services' => Service::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'seo' => $this->pageSeo('services', 'Our Services'),
        ]);
    }

    public function serviceShow(Service $service): View
    {
        abort_unless($service->is_published, 404);

        return view('frontend.services.show', [
            'service' => $service,
            'services' => Service::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'seo' => $service,
        ]);
    }

    public function team(): View
    {
        return view('frontend.team.index', [
            'members' => TeamMember::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'seo' => $this->pageSeo('team', 'Our Team'),
        ]);
    }

    public function teamShow(TeamMember $member): View
    {
        abort_unless($member->is_published, 404);

        return view('frontend.team.show', [
            'member' => $member,
            'seo' => $member,
        ]);
    }

    public function projects(): View
    {
        return view('frontend.projects.index', [
            'projects' => Project::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'seo' => $this->pageSeo('projects', 'Our Projects'),
        ]);
    }

    public function projectShow(Project $project): View
    {
        abort_unless($project->is_published, 404);

        return view('frontend.projects.show', [
            'project' => $project,
            'seo' => $project,
        ]);
    }

    public function blog(): View
    {
        return view('frontend.blog.index', [
            'posts' => Post::query()->where('is_published', true)->orderByDesc('published_at')->paginate(9),
            'seo' => $this->pageSeo('blog', 'Blog'),
        ]);
    }

    public function blogShow(Post $post): View
    {
        abort_unless($post->is_published, 404);

        return view('frontend.blog.show', [
            'post' => $post,
            'seo' => $post,
        ]);
    }

    public function faq(): View
    {
        return view('frontend.pages.faq', [
            'faqs' => Faq::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'seo' => $this->pageSeo('faq', 'FAQs'),
        ]);
    }

    public function page(Page $page): View
    {
        abort_unless($page->is_published, 404);

        return view('frontend.pages.show', [
            'page' => $page,
            'seo' => $page,
        ]);
    }

    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:5000',
        ]);

        // Store or mail later — for now flash success
        return back()->with('success', 'Thank you! Your message has been received.');
    }

    public function quote(Request $request, ?Service $service = null): View
    {
        if ($service && ! $service->is_published) {
            abort(404);
        }

        $selectedPlan = null;
        if ($request->filled('plan')) {
            $selectedPlan = PricingPlan::query()
                ->where('is_published', true)
                ->where(function ($query) use ($request) {
                    $query->where('id', $request->integer('plan'))
                        ->orWhere('name', $request->string('plan')->toString());
                })
                ->first();
        }

        return view('frontend.pages.quote', [
            'services' => Service::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'plans' => PricingPlan::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'selectedService' => $service,
            'selectedPlan' => $selectedPlan,
            'seo' => $this->pageSeo('quote', 'Get A Quote'),
        ]);
    }

    public function quoteSubmit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:40',
            'service_id' => 'required|exists:services,id',
            'plan_id' => 'nullable|exists:pricing_plans,id',
            'message' => 'required|string|max:5000',
        ]);

        $service = Service::query()->where('is_published', true)->findOrFail($data['service_id']);
        $plan = ! empty($data['plan_id'])
            ? PricingPlan::query()->where('is_published', true)->find($data['plan_id'])
            : null;

        $settings = SiteSetting::current();
        $to = $settings->email ?: config('mail.from.address');

        try {
            Mail::to($to)->send(new QuoteRequestMail($data, $service, $plan));
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Quote request saved locally but email could not be sent. Please check mail settings.');
        }

        return redirect()
            ->route('quote')
            ->with('success', 'Thank you! Your quote request for "'.$service->title.'" has been sent.');
    }

    protected function pageSeo(string $slug, string $fallbackTitle)
    {
        return Page::query()->where('slug', $slug)->where('is_published', true)->first()
            ?? tap(new Page([
                'title' => $fallbackTitle,
                'meta_title' => $fallbackTitle.' | '.SiteSetting::current()->site_name,
            ]), fn () => null);
    }
}
