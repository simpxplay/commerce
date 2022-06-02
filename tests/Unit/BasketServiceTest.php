<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Voucher;
use App\Services\BasketService;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class BasketServiceTest extends TestCase
{
    private BasketService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->service = App::make(BasketService::class);
    }

    /**
     * @test
     *
     * Scenario:
     * 2 vouchers:
     *  1)20% on second unit of type A
     *  2)5% if cart greater or equal to 40
     * 6 products (prices):
     *  A - 10
     *  B - 8
     *  C - 12
     * Result:
     *  (10+10+8+12)-0(2 voucher)-2(1 voucher)= 39
     */
    public function calculationTest()
    {
        $data = [
            'voucher_codes' => [Voucher::find(1)->code, Voucher::find(9)->code],
            'product_ids' => ['1', '3', '1', '2']
        ];
        $this->assertEquals($this->service->calculate($data)['total'], 39);
    }

    /**
     * @test
     *
     * Scenario:
     * 2 vouchers:
     *  1)20% on second unit of type A
     *  2)5% if cart greater or equal to 40
     *  3)5$ on type B
     * 6 products (prices):
     *  A - 10
     *  B - 8
     *  C - 12
     * Result:
     *  (10+10+8+12+12+12)-3(2 voucher)-2(1 voucher)-5(3 voucher)= 55.1
     */
    public function calculationSecondTest()
    {
        $data = [
            'voucher_codes' => [Voucher::find(1)->code, Voucher::find(9)->code, Voucher::find(3)->code],
            'product_ids' => ['1', '1', '2', '3', '3', '3']
        ];
        $this->assertEquals($this->service->calculate($data)['total'], 55.1);
    }
}
