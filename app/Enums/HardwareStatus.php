<?php

namespace App\Enums;

class HardwareStatus
{
    const ACTIVE = 'active';

    const INACTIVE = 'inactive';

    const FAULTY = 'Faulty';

    const OUT_OF_SERVICE = 'Out Service';

    const UNDER_MAINTENANCE = 'Under Mantenance';

    const OFFLINE = 'Offline';

    const ONLINE = 'Online';

    const PENDING = 'Pending';

    const DECOMMISSIONED = 'Decommissioned';

    const UPGRADING = 'Upgrading';

    const UNAVAILABLE = 'Unavailable';

    const ERROR = 'Error';

    const READY = 'Ready';

    const UNKNOWN = 'Uknown';

    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::FAULTY,
            self::OUT_OF_SERVICE,
            self::UNDER_MAINTENANCE,
            self::OFFLINE,
            self::ONLINE,
            self::PENDING,
            self::DECOMMISSIONED,
            self::UPGRADING,
            self::UNAVAILABLE,
            self::ERROR,
            self::READY,
            self::UNKNOWN,
        ];
    }

    public static function options(): array
    {
        return [
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::FAULTY => 'Faulty',
            self::OUT_OF_SERVICE => 'Out of Service',
            self::UNDER_MAINTENANCE => 'Under Maintenance',
            self::OFFLINE => 'Offline',
            self::ONLINE => 'Online',
            self::PENDING => 'Pending',
            self::DECOMMISSIONED => 'Decommissioned',
            self::UPGRADING => 'Upgrading',
            self::UNAVAILABLE => 'Unavailable',
            self::ERROR => 'Error',
            self::READY => 'Ready',
            self::UNKNOWN => 'Unknown',
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
