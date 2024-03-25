<?php

declare(strict_types=1);

namespace zonuexe\PHPStan\SafePHP\Type;

use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\Constant\ConstantBooleanType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use function str_starts_with;

class SafeFunctionsDynamicReturnTypeExtension
{
	public function isFunctionSupported(FunctionReflection $functionReflection): bool
	{
		return str_starts_with($functionReflection->getName(), 'Safe\\');
	}

	public function getTypeFromFunctionCall(
		FunctionReflection $functionReflection,
		FuncCall $functionCall,
		Scope $scope,
	): ?Type {
		$name = $functionCall->name;
		if (!$name instanceof Name) {
			return null;
		}

		$builtinName = new Name($name->getLast());
		$builtinFuncCall = new FuncCall($builtinName, $functionCall->args);

		$returnType = $scope->getType($builtinFuncCall);
		$safeType = ParametersAcceptorSelector::selectSingle($functionReflection->getVariants())->getReturnType();
		$falseType = new ConstantBooleanType(false);

		if ($safeType->isSuperTypeOf($falseType)->no()) {
			return TypeCombinator::remove($returnType, $falseType);
		}

		return $returnType;
	}
}
