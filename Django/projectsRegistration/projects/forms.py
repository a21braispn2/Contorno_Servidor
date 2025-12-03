from django import forms
from .models import Project

class ProjectForm(forms.ModelForm):
    class Meta:
        model = Project
        fields = ['title', 'description', 'date']
        widgets = {'date': forms.DateInput(attrs={'type': 'date'})}
