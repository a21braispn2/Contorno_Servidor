# courses/urls.py

from django.urls import path
from . import views

urlpatterns = [
    path('', views.home, name='home'),                     # La raíz de la app courses (ej: /)
    path('courses/', views.courses, name='courses'),   # La lista de cursos (ej: /list/)
    path('<int:pk>/', views.course_detail, name='course_detail'), # El detalle (ej: /1/, /2/)
]