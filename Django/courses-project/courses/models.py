from django.db import models

class Course(models.Model):
 name = models.CharField(max_length=100)
 description = models.CharField(max_length=250)
 image = models.ImageField(upload_to='courses/images/')
 url = models.URLField(blank=True)