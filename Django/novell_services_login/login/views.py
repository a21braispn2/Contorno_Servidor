from django.shortcuts import render

# Create your views here.
def login(request):
    return render(request, 'login/login.html')

def info(request):
    username = str(request.GET.get('username',''))
    password = str(request.GET.get('password',''))
    city = str(request.GET.get('city',''))
    server = str(request.GET.get('server',''))
    role = str(request.GET.get('role',''))
    sso = list(request.GET.getlist('sso'))
 

    return render(request, 'login/info.html', {
        'username': username,
        'password':password,
        'city':city,
        'server':server,
        'role':role,
        'sso':sso
    })