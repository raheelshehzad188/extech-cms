<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Filament\Forms\SeoForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Team')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Profile')
                            ->schema([
                                Section::make()->columns(2)->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, callable $set, ?string $operation) => $operation === 'create' ? $set('slug', Str::slug((string) $state)) : null),
                                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                    TextInput::make('designation'),
                                    TextInput::make('email')->email(),
                                    TextInput::make('phone'),
                                    FileUpload::make('image')->label('Profile Photo')->image()->directory('team')->disk('public'),
                                    FileUpload::make('banner_image')
                                        ->label('Page Banner / Cover')
                                        ->image()
                                        ->directory('team/banners')
                                        ->disk('public')
                                        ->helperText('Is member ke detail page ka banner. Empty ho to Site Settings wali default banner use hogi.'),
                                    Textarea::make('bio')->rows(3)->columnSpanFull(),
                                    RichEditor::make('content')->columnSpanFull(),
                                    TextInput::make('facebook')->url(),
                                    TextInput::make('twitter')->url(),
                                    TextInput::make('linkedin')->url(),
                                    TextInput::make('instagram')->url(),
                                    Repeater::make('skills')->simple(TextInput::make('skill'))->columnSpanFull(),
                                    Toggle::make('is_featured'),
                                    Toggle::make('is_published')->default(true),
                                    TextInput::make('sort_order')->numeric()->default(0),
                                ]),
                            ]),
                        Tab::make('SEO')
                            ->schema([SeoForm::section()]),
                    ]),
            ]);
    }
}
