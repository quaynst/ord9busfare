<?php
/**
 * Created by PhpStorm.
 * User: Koji
 * Date: 2018/04/08
 * Time: 19:52
 */

class Passenger
{
    /**
     * @var string 年齢区分
     * A : 大人
     * C : 小学生
     * I * 幼児
     */
    public $oldType;

    /**
     * @var string  料金区分
     * n : 通常
     * p : 定期券
     * w : 福祉割引
     */
    public $fareType;

    /**
     * @var bool 値引き対象かどうか (幼児のみ)
     */
    public $isDiscountTarget;

    /**
     * Passenger constructor.
     * @param string $passengerLabel
     * eg) Ap : 大人定期券, Cn : 小学生通常
     */
    public function __construct($passengerLabel)
    {
        $this->oldType = $passengerLabel[0];
        $this->fareType = $passengerLabel[1];
    }

    /**
     * 通常料金から料金を計算する
     * @param int $standardFare
     * @return int
     */
    public function GetFare(int $standardFare)
    {
        // 定期券の人はお金払わない
        if ($this->fareType == 'p') {
            return 0;
        }

        $rate = 1;
        // 福祉割引は通常料金の半額
        if ($this->fareType == 'w') {
            $rate *= 0.5;
        }

        // 子どもの通常料金は大人の半額
        if ($this->IsChild()) {
            $rate *= 0.5;
        }

        // 10円未満は切り上げ
        return (int)ceil($standardFare * $rate / 10) * 10;
    }

    /**
     * 子どもかどうか。通常料金が大人の半額になる
     * @return bool
     */
    public function IsChild()
    {
        return $this->oldType == 'C' || $this->oldType == 'I';
    }

    /**
     * 幼児かどうか。大人1人あたり幼児2人まで無料になる
     * @return bool
     */
    public function IsInfant()
    {
        return $this->oldType == 'I';
    }
}