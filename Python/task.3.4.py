def factorial(n):
    if type(n) != int:
        raise TypeError("Must be an integer.")
    if n < 0:
        raise ValueError("Must be greater than or equal to 0.")

    result = 1
    for x in range(1, n + 1):
        result *= x

    return result


try:
    number = int(input("Enter a number: "))
    print(f"The factorial of {number} is {factorial(number)}")

except ValueError as ve:
    print(f"Value Error: {ve}")

except TypeError as te:
    print(f"Type Error: {te}")

except Exception as e:
    print(f"Error: {e}")
