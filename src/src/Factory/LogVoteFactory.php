<?php

namespace App\Factory;

use App\Entity\LogVote;
use App\Repository\LogVoteRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<LogVote>
 *
 * @method static LogVote|Proxy createOne(array $attributes = [])
 * @method static LogVote[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static LogVote[]|Proxy[] createSequence(array|callable $sequence)
 * @method static LogVote|Proxy find(object|array|mixed $criteria)
 * @method static LogVote|Proxy findOrCreate(array $attributes)
 * @method static LogVote|Proxy first(string $sortedField = 'id')
 * @method static LogVote|Proxy last(string $sortedField = 'id')
 * @method static LogVote|Proxy random(array $attributes = [])
 * @method static LogVote|Proxy randomOrCreate(array $attributes = [])
 * @method static LogVote[]|Proxy[] all()
 * @method static LogVote[]|Proxy[] findBy(array $attributes)
 * @method static LogVote[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static LogVote[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LogVoteRepository|RepositoryProxy repository()
 * @method LogVote|Proxy create(array|callable $attributes = [])
 */
final class LogVoteFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'score' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(LogVote $logVote): void {})
        ;
    }

    protected static function getClass(): string
    {
        return LogVote::class;
    }
}
