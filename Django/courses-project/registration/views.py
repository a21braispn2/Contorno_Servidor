from django.shortcuts import render, redirect

def registration(request):
    return render(request, 'registration/registration_form.html')

def registration_form(request):
    name = str(request.GET.get('name',''))
    surname = str(request.GET.get('surname',''))
    age = int(request.GET.get('age',0))
    date = request.GET.get('date','')
    
    return render(request, 'registration/registration_result.html',{
        'name':name,
        'surname':surname,
        'age':age,
        'date':date
        
    })