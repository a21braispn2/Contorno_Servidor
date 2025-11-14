words = ["List", "Dictionary", "Array"]
definitions = ["Ordered array of objects", "Unordered array of key-value pairs", "Mathematic definition"]

cooldictionary = {}
for i in range(len(words)):
    cooldictionary[words[i]] = definitions[i]

print("The contents of the dictionary are:\n")
for key, value in cooldictionary.items():
    print(f"{key}: {value}\n")
