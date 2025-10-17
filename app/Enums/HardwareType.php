<?php

namespace App\Enums;

class HardwareType
{
    const DESKTOP = 'desktop';

    const LAPTOP = 'laptop';

    const TABLET = 'tablet';

    const ANDROID = 'android';

    const IPHONE = 'iphone';

    const SERVER = 'server';

    const PRINTER = 'printer';

    const ROUTER = 'router';

    const SWITCH = 'switch';

    public static function all(): array
    {
        return [
            self::DESKTOP,
            self::LAPTOP,
            self::TABLET,
            self::ANDROID,
            self::IPHONE,
            self::SERVER,
            self::PRINTER,
            self::ROUTER,
            self::SWITCH,
        ];
    }

    public static function options(): array
    {
        return [
            self::DESKTOP => 'Desktop',
            self::LAPTOP => 'Laptop',
            self::TABLET => 'Tablet',
            self::ANDROID => 'Android',
            self::IPHONE => 'iPhone',
            self::SERVER => 'Server',
            self::PRINTER => 'Printer',
            self::ROUTER => 'Router',
            self::SWITCH => 'Switch',
        ];
    }

    public static function getLabel($value): string
    {
        // Handle numeric values from old database records
        if (is_numeric($value)) {
            $allValues = self::all();
            if (isset($allValues[$value])) {
                $value = $allValues[$value];
            }
        }
        
        $options = self::options();
        return $options[$value] ?? ucfirst($value ?? 'Unknown');
    }
}
