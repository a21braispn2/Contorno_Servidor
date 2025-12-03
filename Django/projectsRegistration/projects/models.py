from django.db import models
from django.contrib.auth.models import User

# Create your models here.
class Project(models.Model):
    title = models.CharField(max_length=100)
    description = models.CharField(max_length=500)
    date = models.DateTimeField(
        null=True, blank=True
    )
    manager= models.ForeignKey(
        User, on_delete=models.CASCADE
    )
    
    def __str__(self):
        return self.title