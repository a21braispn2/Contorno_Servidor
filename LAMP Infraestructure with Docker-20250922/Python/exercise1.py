# I have provided you with two lists. words and definitions:

# words = ["List", "Dictionary", "Array"]

# definitions = ["Ordered array of objects", "Unordered array of key-value pairs", "Mathematic definition"]

 
# Use loops in both sections.
# Create a dictionary called cooldictionary where you use words for keys and definitions for values
# Print the dictionary with the following format:
#                The contents of the dictionary are:

#                      List: Ordered array of objects

#                      Dictionary: Unordered...

#                      ...


words = ["List", "Dictionary", "Array"]

definitions = ["Ordered array of objects", "Unordered array of key-value pairs", "Mathematic definition"]

cooldictionary = {}

for x in range(0,len(words)):
    cooldictionary[words[x]] = definitions[x]

print("The contents of the dictionary are:\n" )
for x in cooldictionary: print(x + ": " + cooldictionary[x] + "\n")