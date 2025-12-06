<?php

declare(strict_types=1);

use Cog\Laravel\Clickhouse\Migration\AbstractClickhouseMigration;

return new class extends AbstractClickhouseMigration
{
    public function up(): void
    {
        $this->clickhouseClient->write(
            <<<SQL
                CREATE TABLE IF NOT EXISTS car_card
                (
                    id UInt32,
                    category_id UInt32,
                    model_id UInt32,
                    drive_id UInt32,
                    transmission_id UInt32,
                    bodywork_id UInt32,
                    color_id UInt32,
                    sign UInt8,
                    mark_id UInt32,
                    engine_id UInt32,
                    user_id UInt32,
                    timestamp DateTime64(3), 
                )
                ENGINE = MergeTree()
                ORDER BY (id, timestamp)
            SQL
        );
    }
};
