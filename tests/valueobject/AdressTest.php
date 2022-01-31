<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\City
 */
class AdressTest extends TestCase
{
    /**
     * @dataProvider goodAdresses
     */
    public function testGoodAdresses(...$data) : void
    {
        $inquiry = Adress::set(
            Email::fromString($data[0]),
            Name::fromString($data[1]),
            Name::fromString($data[2]),
            Street::fromString($data[3]),
            ZipCode::fromString($data[4]),
            City::fromString($data[5]),
            State::fromString($data[6]),
            Country::fromString($data[7]),
            Phone::fromString($data[8]),
            Company::fromString($data[9])
        );

        $processedData = array(
            $inquiry->getEmail(),
            $inquiry->getFirstname(),
            $inquiry->getLastname(),
            $inquiry->getStreet(),
            $inquiry->getZipCode(),
            $inquiry->getCity(),
            $inquiry->getState(),
            $inquiry->getCountry(),
            $inquiry->getPhone(),
            $inquiry->getCompany()
        );
        self::assertEquals($data,$processedData);
    }

    public function goodAdresses() : array
    {
        return [
            ['anatolij.vasilev@live.de', 'Anatolij', 'Vasilev', 'Hansatraße 24', '12346', 'Berlin', 'Berlin', 'Deutschland', '0301781567', 'Flyeralarm'],
            ['krasser.dude@flyeralarm.de', 'Krasser', 'Dude', 'Würzburger Str. 107', '94112', 'Würzburg', 'Bayern', 'Deutschland', '+490301781567', 'Flyeralarm']
        ];
    }
}
