<?php

namespace Src\OutSourcing\CurrencyCalculator\Presentation\HTTP;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Auth\Domain\AuthInterface;
use Src\Common\Domain\Exceptions\UnauthorizedUserException;
use Src\OutSourcing\CurrencyCalculator\Application\Exceptions\ApiErrorLimitException;
use Src\OutSourcing\CurrencyCalculator\Application\Mappers\CurrencyCalculatorMapper;
use Src\OutSourcing\CurrencyCalculator\Application\UseCases\Commands\StoreCurrencyCalculatorCommand;
use Src\OutSourcing\CurrencyCalculator\Application\UseCases\Queries\FindAllCurrencyCalculatorsQuery;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

final class CurrencyCalculatorController
{
    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function index(): JsonResponse
    {
        try {
            return response()->success((new FindAllCurrencyCalculatorsQuery())->handle());
        } catch (UnauthorizedUserException $e) {
            return response()->error([$e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }


    public function store(Request $request): JsonResponse
    {
        // TODO: podria mejorarse el check del usuario...
        $is_anonymus = true;
        try  {
            $is_anonymus = !JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            $is_anonymus = true;
        }

        try {
            $currency_calculator = CurrencyCalculatorMapper::fromRequest($request,$request->ip());
            $currency_calculatorData = (new StoreCurrencyCalculatorCommand($currency_calculator, $is_anonymus))->execute();
            return response()->success($currency_calculatorData, Response::HTTP_CREATED);
        } catch (ApiErrorLimitException $domainException) {
            return response()->error([$domainException->getMessage()], Response::HTTP_FORBIDDEN);
        } catch (\DomainException $domainException) {
            return response()->error([$domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (UnauthorizedUserException $e) {
            return response()->error([$e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }


}