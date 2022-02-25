<?php

/*
 * This file is part of the Kimai time-tracking app.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Widget\Type;

use App\Entity\User;
use App\Repository\TimesheetRepository;
use App\Widget\Type\AbstractUserRevenuePeriod;
use App\Widget\Type\AbstractWidget;
use App\Widget\Type\UserAmountWeek;
use App\Widget\WidgetInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * @covers \App\Widget\Type\UserAmountWeek
 * @covers \App\Widget\Type\AbstractUserRevenuePeriod
 */
class UserAmountWeekTest extends AbstractWidgetTest
{
    protected function assertDefaultData(AbstractWidget $sut)
    {
        self::assertEquals(0.0, $sut->getData());
    }

    /**
     * @return AbstractUserRevenuePeriod
     */
    public function createSut(): AbstractWidget
    {
        $repository = $this->createMock(TimesheetRepository::class);
        $dispatcher = $this->createMock(EventDispatcherInterface::class);

        $widget = new UserAmountWeek($repository, $dispatcher);
        $widget->setUser(new User());

        return $widget;
    }

    public function getDefaultOptions(): array
    {
        return [
            'icon' => 'money',
            'color' => WidgetInterface::COLOR_WEEK,
        ];
    }

    public function testSettings()
    {
        $sut = $this->createSut();

        self::assertEquals('widget/widget-counter-money.html.twig', $sut->getTemplateName());
        self::assertEquals('userAmountWeek', $sut->getId());
    }
}