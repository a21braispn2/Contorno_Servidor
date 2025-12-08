from django.shortcuts import render, redirect
from .forms import RegistrationForm
# Create your views here.

def registration(request):
    return render(request, 'registration/registration.html')

def registration_form(request):
    if request.method == 'POST':
        form = RegistrationForm(request.POST)
        
        if form.is_valid():
            # No guardamos el objeto en la BD (form.save()) si solo queremos mostrarlo,
            # pero es una buena práctica validarlo.
            
            # 🚨 En lugar de guardar, extraemos y mostramos los datos validados
            data = form.cleaned_data 
            
            # Renderizamos la plantilla que muestra los resultados, pasando los datos
            return render(request, 'registration/registration_result.html', {'data': data})
    
    # Si la solicitud es un GET, inicializamos un formulario vacío.
    else:
        form = RegistrationForm()
        
    # Renderizamos la plantilla que contiene el formulario
    return render(request, 'registration/registration_form.html', {'form': form})