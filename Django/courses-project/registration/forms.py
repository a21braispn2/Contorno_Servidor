# registration/forms.py

from django import forms
from .models import Registration

class RegistrationForm(forms.ModelForm):
    class Meta:
        model = Registration
        fields = ['name', 'surname', 'age', 'date'] 
        widgets = {
            'date': forms.DateInput(attrs={'type': 'date'})
        }