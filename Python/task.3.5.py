def tripleCheck(numbers):
    for i in range(len(numbers) - 2):
        if numbers[i] == numbers[i + 1] == numbers[i + 2]:
            return True
    return False

samples = [
    [1, 1, 2, 2, 1],
    [1, 1, 2, 1, 2, 3],
    [1, 1, 1, 2, 2, 2, 1]
]

print("Triple Check Results:")
for i, sample in enumerate(samples, 1):
    print(f"Sample {i}: {tripleCheck(sample)}")


def showCountries(countries, selected):
    print("\nCountry Capitals:")
    for country in selected:
        capital = countries.get(country)
        if capital:
            print(f"The capital of {country} is {capital}")

countries = {
    "Italy": "Rome", "Luxembourg": "Luxembourg", "Belgium": "Brussels", "Denmark": "Copenhagen",
    "Finland": "Helsinki", "France": "Paris", "Slovakia": "Bratislava", "Slovenia": "Ljubljana",
    "Germany": "Berlin", "Greece": "Athens", "Ireland": "Dublin", "Netherlands": "Amsterdam",
    "Portugal": "Lisbon", "Spain": "Madrid", "Sweden": "Stockholm", "United Kingdom": "London",
    "Cyprus": "Nicosia", "Lithuania": "Vilnius", "Czech Republic": "Prague", "Estonia": "Tallin",
    "Hungary": "Budapest", "Latvia": "Riga", "Malta": "Valetta", "Austria": "Vienna", "Poland": "Warsaw"
}

selected = ["Netherlands", "Greece", "Germany"]
showCountries(countries, selected)
