# registration/urls.py

from django.urls import path
from . import views

urlpatterns = [
    path('', views.registration_form, name='registration_form'), 
    path('submit/', views.registration, name='registration_submit'), 
]