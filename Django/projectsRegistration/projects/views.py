from django.db import IntegrityError
from django.shortcuts import render, redirect
from django.contrib.auth.models import User
from django.contrib.auth.forms import UserCreationForm, AuthenticationForm
from django.contrib.auth import login, logout, authenticate
from django.contrib.auth.decorators import login_required
from .models import Project
from django.shortcuts import render, get_object_or_404, redirect
from .forms import ProjectForm
# Create your views here.
def main(request):
    return render(request, "projects/main.html")


def signupuser(request):
    if request.method == "GET":  # primeira vez que se carga a páxina
        return render(request, "projects/signuser.html", {"form": UserCreationForm()})
    else:  # despois de sign up
        if (
            request.POST["password1"] == request.POST["password2"]
        ):  # se as contraseñas coinciden
            try:
                user = User.objects.create_user(
                    request.POST["username"], password=request.POST["password1"]
                )
                user.save()
                login(request, user)
                return redirect("projects-list")
            except IntegrityError:
                return render(
                    request,
                    "projects/signuser.html",
                    {
                        "form": UserCreationForm(),
                        "error": "Username already taken, please choose another one.",
                    },
                )
        else:  # se non coinciden as contraseñas
            return render(
                request,
                "projects/signuser.html",
                {"form": UserCreationForm(), "error": "Passwords did not match."},
            )
            
@login_required
def logoutuser(request):
    if request.method == "POST":
        logout(request)
        return redirect("main")
    

def loginuser(request):
    if request.method == "GET":
        return render(request, "projects/loginuser.html", {"form": AuthenticationForm()})
    else:
        try:
            user = authenticate(
                request,
                username=request.POST["username"],
                password=request.POST["password"],
            )
            if user is None:
                return render(
                    request,
                    "projects/loginuser.html",
                    {
                        "form": AuthenticationForm(),
                        "error": "Username or password did not match. Please, try again.",
                    },
                )
            else:
                login(request, user)
                return redirect("projects-list")
        except Exception:
            return render(
                request,
                "projects/loginuser.html",
                {
                    "form": AuthenticationForm(),
                    "error": "ERROR.",
                },
            )
            
            
@login_required
def projects_list(request):
    projects = Project.objects.filter(manager=request.user).order_by('-date')
    return render(request, 'projects/projects_list.html', {'projects': projects})


@login_required
def project_detail(request, project_pk):
    project = get_object_or_404(Project, pk=project_pk, manager=request.user)

    if request.method == 'POST':

        # DELETE
        if 'delete' in request.POST:
            project.delete()
            return redirect('projects-list')

        # UPDATE
        form = ProjectForm(request.POST, instance=project)
        if form.is_valid():
            form.save()
            return redirect('projects-list')

    else:
        form = ProjectForm(instance=project)

    return render(request, 'projects/project_detail.html', {'form': form})


@login_required
def create_project(request):
    if request.method == "POST":
        form = ProjectForm(request.POST)
        if form.is_valid():
            project = form.save(commit=False)
            project.manager = request.user
            project.save()
            return redirect('projects-list')
    else:
        form = ProjectForm()
    return render(request, 'projects/create_project.html', {'form': form})
    