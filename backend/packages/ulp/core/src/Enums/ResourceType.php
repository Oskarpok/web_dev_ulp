<?php

declare(strict_types=1);

namespace Ulp\Core\Enums;

enum ResourceType: string {

    case Image = 'image';
    case Video = 'video';
    case Document = 'document';
    case Audio = 'audio';
    case Archive = 'archive';
    case Other = 'other';

    public function label(): string {
      return match($this) {
        self::Image => 'Obrazy',
        self::Video => 'Filmy',
        self::Document => 'Dokumenty',
        self::Audio => 'Dźwięki',
        self::Archive => 'Archiwa',
        self::Other => 'Inne',
      };
    }

    public static function defaultExtensions(): array {
      return [
        self::Image->name => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
        self::Video->name => ['mp4', 'mov', 'avi', 'wmv'],
        self::Document->name => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt'],
        self::Audio->name => ['mp3', 'wav', 'ogg'],
        self::Archive->name => ['zip', 'rar', '7z', 'tar'],
        self::Other->name => [],
      ];
    }

    public static function toArray(): array {
      return collect(self::cases())
        ->mapWithKeys(fn($case) => [$case->value => $case->label()])
        ->toArray();
    }
    
}