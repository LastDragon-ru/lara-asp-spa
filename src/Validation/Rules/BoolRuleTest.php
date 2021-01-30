<?php declare(strict_types = 1);

namespace LastDragon_ru\LaraASP\Spa\Validation\Rules;

use Illuminate\Contracts\Translation\Translator;
use LastDragon_ru\LaraASP\Spa\Testing\TestCase;

/**
 * @internal
 * @coversDefaultClass \LastDragon_ru\LaraASP\Spa\Validation\Rules\BoolRule
 */
class BoolRuleTest extends TestCase {
    // <editor-fold desc="Tests">
    // =========================================================================
    /**
     * @covers ::passes
     *
     * @dataProvider dataProviderPasses
     *
     * @param bool  $expected
     * @param mixed $value
     *
     * @return void
     */
    public function testPasses(bool $expected, $value): void {
        $translator = $this->app->make(Translator::class);
        $rule       = new BoolRule($translator);

        $this->assertEquals($expected, $rule->passes('attribute', $value));
    }

    /**
     * @covers ::message
     */
    public function testMessage(): void {
        $translator = $this->app->make(Translator::class);
        $rule       = new BoolRule($translator);

        $this->assertEquals('The :attribute is not a boolean.', $rule->message());
    }
    // </editor-fold>

    // <editor-fold desc="DataProviders">
    // =========================================================================
    public function dataProviderPasses(): array {
        return [
            'true'  => [true, true],
            'false' => [true, false],
            '0'     => [false, 0],
            '1'     => [false, 1],
            '"0"'   => [false, '0'],
            '"1"'   => [false, '1'],
        ];
    }
    // </editor-fold>
}
