# In python the None keyword is used to define a null value, or no value at all.

# Write a function that receives:

# - A string, name, that can be null

# - A string, surname, optional, default value "Apelido"

# - An int, age.

# It doesn't return anything.

# The function shows a string on the screen showing:    Nome Apelido is xx years old.

# If name is null then it shows:    Apelido is xx years old.

def function(name, age, surname = "Apelido"):
    if name == None:
        age = "xx"
    elif type(name) != str:
        return "Error"
    if type(surname) != str:
        return "Error"
    if type(age) != int:
        return "Error"

    print(f"{name} {surname} is {age} years old")
function()