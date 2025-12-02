from django.db import models

class Course(models.Model):
 name = models.CharField(max_length=100)
 description = models.CharField(max_length=250)
 image = models.ImageField(upload_to='courses/images/')

class Registration(models.Model):
    name = models.CharField(max_length=100)
    surname = models.CharField(max_length=100)
    age = models.IntegerField()
    date = models.DateField(auto_now_add=True)