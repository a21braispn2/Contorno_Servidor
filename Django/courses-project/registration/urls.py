# registration/urls.py

from django.urls import path
from . import views

urlpatterns = [
    path('', views.registration, name='registration'), 
    path('result/', views.registration_form, name='registration_form'), 
]