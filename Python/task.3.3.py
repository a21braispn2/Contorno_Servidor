def potencia(base, exponent):
    if type(base) != int or type(exponent) != int:
        raise TypeError("Both numbers must be integers.")

    result = 1

    if exponent > 0:
        for x in range(exponent):
            result *= base
    elif exponent < 0:
        for x in range(-exponent):
            result *= base
        result = 1 / result
    else:
        result = 1

    return result


try:
    b = int(input("Enter the base: "))
    e = int(input("Enter the exponent: "))

    print(f"The result of {b}^{e} is {potencia(b, e)}")

except ValueError:
    print("Error: please enter valid integers.")

except TypeError as te:
    print(f"Error: {te}")

except ZeroDivisionError:
    print("Error: division by zero when using a negative exponent with base 0.")

except Exception as e:
    print(f"Error: {e}")
