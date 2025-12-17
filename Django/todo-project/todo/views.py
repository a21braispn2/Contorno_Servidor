from django.shortcuts import render, redirect

# Create your views here.

def authenticate(request):
    return 

def loginUser(request):
    if request.method == 'GET':
        return render(request, 'todo/loginuser.html', {'form':AuthenticationForm()})
    else:
        user = authenticate(request, username=request.POST['username'], password=request.POST['password'])
        if user is None:
            return render(request, 'todo/loginUser.html', {'form':AuthenticationForm(), 'error':'Username and password did not match'})
        else:
            login(request, user)
            return redirect('currenttodoss')