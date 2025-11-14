from django.shortcuts import render
import random
import string

def home(request):
    return render(request, 'generator/home.html')

def password(request):
    length = int(request.GET.get('length', 12))

    characters = string.ascii_lowercase + string.ascii_uppercase + string.digits + '!@#$%&*()'

    generated_password = ''.join(random.choice(characters) for _ in range(length))

    return render(request, 'generator/password.html', {
        'password': generated_password
    })
def about(request):
    return render(request, 'generator/about.html')