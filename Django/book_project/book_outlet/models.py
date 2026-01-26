from django.db import models
from django.core.validators import MinValueValidator, MaxValueValidator

class Address(models.Model):
    street = models.CharField(max_length=250)
    postal_code= models.CharField(max_length=10)
    city = models.CharField(max_length=200)
    def __str__(self):
        return f"{self.street}, {self.postal_code}, {self.city}"

class Author(models.Model):
    first_name = models.CharField(max_length=100)
    last_name = models.CharField(max_length=100)
    
    def __str__(self):
        return f'{self.first_name} {self.last_name}'


class Book(models.Model):
    title = models.CharField(max_length=50)
    rating = models.IntegerField(validators=[MinValueValidator(1), MaxValueValidator(5)])
    is_bestselling = models.BooleanField(default=False) #We are setting a default value
    author = models.ForeignKey(Author, on_delete=models.SET_NULL, null=True, related_name="fkbooks")
    
    def __str__(self):
        return f'{self.title} ({self.rating})'

