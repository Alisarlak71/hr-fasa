<?php

namespace App\Jobs;


use App\Enums\FileStatuses;
use App\Events\ImportDataProcessed;
use App\Models\Report;
use App\Models\ReportFileLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportReportJob implements ShouldQueue
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
                $report = new Report();
                $report->username = $data[0];
                $report->kernel_order_no = $data[1];
                $report->name = $data[2];
                $report->order_no = $data[3];
                $report->time = $data[4];
                $report->symbol = $data[5];
                $report->date = $data[6];
                $report->post = $data[7];
                $report->international_id = $data[8];
                $report->trader_code = $data[9];
                $report->burse_code = $data[10];
                $report->volume = $data[11];
                $report->price = $data[12];
                $report->done_volume = $data[13];
                $report->status = $data[14];
                $report->error = $data[15];
                $report->accounting = $data[16];
                $report->user_id = $this->reportFileLog->user_id;
                $report->company_id = $this->reportFileLog->user->company->id;
                $report->save();
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
