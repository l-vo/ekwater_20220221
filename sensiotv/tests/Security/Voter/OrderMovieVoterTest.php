<?php

namespace App\Tests\Security\Voter;

use App\Entity\Movie;
use App\Entity\User;
use App\Security\Voter\OrderMovieVoter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\NullToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class OrderMovieVoterTest extends TestCase
{
    public function provideVote(): array
    {
        $adultUser = new User();
        $adultUser->setBirthdate(new \DateTimeImmutable('1979-07-29 11:50:00'));
        $adultUserToken = new UsernamePasswordToken($adultUser, 'main');
        $movieWithoutRating = new Movie();
        $movieNC17 = new Movie();
        $movieNC17->setRated('NC-17');

        $youngUser = new User();
        $youngUser->setBirthdate(new \DateTimeImmutable('2013-06-12 10:00:00'));
        $youngUserToken = new UsernamePasswordToken($youngUser, 'main');

        return [
            'other attribute' => [$adultUserToken, 'foo', $movieWithoutRating, VoterInterface::ACCESS_ABSTAIN],
            'wrong subject' => [$adultUserToken, 'ORDER_MOVIE', new User(), VoterInterface::ACCESS_DENIED],
            'not connected user' => [new NullToken(), 'ORDER_MOVIE', $movieWithoutRating, VoterInterface::ACCESS_DENIED],
            'movie without rating' => [$adultUserToken, 'ORDER_MOVIE', $movieWithoutRating, VoterInterface::ACCESS_GRANTED],
            'user authorized' => [$adultUserToken, 'ORDER_MOVIE', $movieNC17, VoterInterface::ACCESS_GRANTED],
            'user not authorized' => [$youngUserToken, 'ORDER_MOVIE', $movieNC17, VoterInterface::ACCESS_DENIED],

        ];
    }

    /**
     * @dataProvider provideVote
     */
    public function testVote(TokenInterface $token, string $attribute, mixed $subject, int $expectedDecision): void
    {
        $voter = new OrderMovieVoter();
        $decision = $voter->vote($token, $subject, [$attribute]);

        $this->assertSame($expectedDecision, $decision, 'Wrong decision returned by the voter');
    }
}
