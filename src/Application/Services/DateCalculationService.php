<?php

declare(strict_types=1);

namespace App\Application\Services;

/**
 * 日付計算サービス
 * 
 * 年数や経験年数の計算を行うサービスです。
 * DRY原則に従い、重複するロジックを一元化します。
 */
readonly class DateCalculationService
{
    /**
     * コンストラクタ
     * 
     * @param array $dateConfig 日付設定
     */
    public function __construct(
        private array $dateConfig
    ) {}

    /**
     * 職歴年数を計算
     * 
     * 4月以降は現在年から開始年を減算
     * 4月以前は1年少なく計算
     * 
     * @return int 職歴年数
     */
    public function calculateJobAge(): int
    {
        $currentMonth = (int)date('n');
        $currentYear = (int)date('Y');
        
        return $currentMonth >= 4 
            ? $currentYear - $this->dateConfig['job_start_year']
            : $currentYear - $this->dateConfig['job_start_year_offset'];
    }

    /**
     * エンジニア経験年数を計算
     * 
     * @return int エンジニア経験年数
     */
    public function calculateEngineerAge(): int
    {
        return (int)date('Y') - $this->dateConfig['engineer_start_year'];
    }
}