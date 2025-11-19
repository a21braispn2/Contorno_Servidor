from django.db import models

class Registration(models.Model):
 name = models.CharField(max_length=100)
 description = models.CharField(max_length=250)
 image = models.ImageField(upload_to='registration/images/')
 url = models.URLField(blank=True)