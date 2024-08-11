<?php

namespace App\Jobs;


use App\Enums\FileStatuses;
use App\Events\ImportDataProcessed;
use App\Models\Asset;
use App\Models\Report;
use App\Models\ReportFileLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Log\Logger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportAssetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ReportFileLog $reportFileLog;

    public function __construct(ReportFileLog $reportFileLog)
    {
        $this->reportFileLog = $reportFileLog;
    }

    public function handle(): void
    {
        try {
            $open = fopen($this->reportFileLog->path, "r");
            $header = fgetcsv($open);
            while (($data = fgetcsv($open, 1000, "\t")) !== FALSE) {
                Log::debug($data);
                $asset = new Asset();
                $asset->symbol = $data[0];
                $asset->sent_order = $data[1];
                $asset->percent_of_portfolio = $data[2];
                $asset->retained_asset = $data[3];
                $asset->break_even_price = $data[4];
                $asset->stock_price = $data[5];
                $asset->percentage_change = $data[6];
                $asset->pure_sell_price = $data[7];
                $asset->profit_loss = $data[8];
                $asset->retained_profit_loss = $data[9];
                $asset->percentage_retained_profit_loss = $data[10];
                $asset->user_id = $this->reportFileLog->user_id;
                $asset->company_id = $this->reportFileLog->user->company->id;
                $asset->save();
            }

            fclose($open);
            $this->reportFileLog->status = FileStatuses::IMPORTED;
        } catch (\Exception $exception) {
            $this->reportFileLog->status = FileStatuses::IMPORTED_ERROR;
            \Log::debug($exception->getMessage());
        }

        $this->reportFileLog->save();
//        ImportDataProcessed::dispatch($this->reportFileLog);
        event(new ImportDataProcessed($this->reportFileLog->load(['user','user.company'])));
    }
}
