from django.shortcuts import render, get_object_or_404
from .models import Course


# Create your views here.
def home(request):
    return render(request, 'courses/home.html')
def courses(request):
    courses = Course.objects.all()
    return render(request, 'courses/courses.html',{'courses':courses})
def course_detail(request, pk):
    course = get_object_or_404(Course, pk=pk)
    
    context = {
        'course': course
    }
    return render(request, 'courses/course_detail.html', context)