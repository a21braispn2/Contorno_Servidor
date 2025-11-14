def show_person(name=None, surname="Apelido", age=0):
    if name is None:
        print(f"{surname} is {age} years old.")
    else:
        print(f"{name} {surname} is {age} years old.")

show_person("Brais", "Pose", 19)

show_person(None, "García", 30)

show_person(None, age=20)
