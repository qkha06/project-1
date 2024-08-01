<?php

namespace App\Services;

use App\Services\Interfaces\InvoiceServiceInterface;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;

/**
 * Class InvoiceService
 * @package App\Services
 */
class InvoiceService implements InvoiceServiceInterface
{
    protected $withdrawRopistory;

    public function __construct(WithdrawRepository $withdrawRopistory) {
        $this->withdrawRopistory = $withdrawRopistory;
    }

    public function index($request)
    {
        function splitString($s) {
            $pattern = '/([<>]=?|=)(\d+)/';
            if (preg_match($pattern, $s, $matches)) {
                return [$matches[1], $matches[2]];
            } else {
                return [null, null];
            }
        }

        $keyword = addslashes($request->input('keyword'));
        $created_at = addslashes($request->input('created_at'));
        $status = addslashes($request->input('status'));
        $costs = addslashes($request->input('costs'));
        $type = addslashes($request->input('type'));
        $method = addslashes($request->input('method'));
        $bill_info = addslashes($request->input('bill_info'));
        $amount = addslashes($request->input('amount'));

        $condition = [
            'where' => [],
            'orWhere' => []
        ];

        if (!empty($amount)) {
            list($oprAmount, $numAmount) = splitString($amount);
            if (!empty($oprAmount) && !empty($numAmount)) {
                $condition['where'][] = ['amount', $oprAmount, $numAmount];
            }
        }
        if (!empty($costs)) {
            list($oprCosts, $numCosts) = splitString($costs);
            if (!empty($oprCosts) && !empty($numCosts)) {
                $condition['where'][] = ['costs', $oprCosts, $numCosts];
            }
        }

        if ($type != '-1') {
            $condition['where'][] = ['type', '=', $type];
        }
        if (!empty($method) && $method != '-1') {
            $condition['where'][] = ['payment_method', '=', $method];
        }
        if (!empty($status) && $status != '-1') {
            $condition['where'][] = ['status', '=', $status];
        }
        if (!empty($keyword)) {
            $condition['orWhere'] = [
                // ['name', 'LIKE', ('%'.$keyword.'%')],
                ['costs', 'LIKE', ('%'.$keyword.'%')],
                ['amount', 'LIKE', ('%'.$keyword.'%')],
                ['costs', 'LIKE', ('%'.$keyword.'%')],
                ['id', 'LIKE', ('%'.$keyword.'%')]
            ];
        }
        if (!empty($bill_info)) {
            $condition['where'][] = ['payment_account_number', 'LIKE', ('%'.$bill_info.'%')];
            $condition['orWhere'][] = ['payment_account_name', 'LIKE', ('%'.$bill_info.'%')];
        }
        if (!empty($bill_info)) {
            $condition['orWhere'][] = ['payment_account_number', 'LIKE', ('%'.$bill_info.'%')];
            $condition['where'][] = ['payment_account_name', 'LIKE', ('%'.$bill_info.'%')];
        }
        $invoices = $this->withdrawRopistory->pagination(['*'], $condition);
        return $invoices;
    }

}
