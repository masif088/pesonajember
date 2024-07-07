<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class MailHistory extends \App\Models\MailHistory implements View
{

    public static function tableSearch($params = null): Builder
    {
//        'type_mail', 'model_type', 'model_id', 'mail', 'title', 'content'
        $query = $params['query'];
        return empty($query) ? static::query() : static::query()
            ->where('mail', 'like', "%$query%")
            ->orWhere('title', 'like', "%$query%")
            ->orWhere('type_mail', 'like', "%$query%");
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
        //        'type_mail', 'model_type', 'model_id', 'mail', 'title', 'content'
        return [
            ['label' => 'Alamat email', 'sort' => 'bank_name'],
            ['label' => 'Jenis', 'sort' => 'account_in_name'],
            ['label' => 'Isi', 'sort' => 'status_id'],
            ['label' => 'Dikirim pada'],
        ];
    }

    public static function tableData($data = null): array
    {
        return [
            ['type' => 'string', 'data' => $data->mail],
            ['type' => 'string', 'data' => $data->type_mail],
            ['type' => 'raw_html', 'data' => "<div>$data->title</div><div style='font-size: 12px'>$data->content</div>"],
            ['type' => 'string', 'data' => $data->created_at],
        ];
    }
}
