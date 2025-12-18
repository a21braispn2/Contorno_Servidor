from django.shortcuts import render

# Create your views here.
from django.shortcuts import render
from django.db.models import Q
from .models import Book

def book_list(request):
    # Query 1: The books with the highest rating.
    high_rated_books = Book.objects.order_by('-rating')

    # Query 2: The books that have the pattern “Potter” in the title and are bestselling or have a rating over 3.
    potter_complex_query = Book.objects.filter(
        title__icontains='Potter'
    ).filter(
        Q(is_bestselling=True) | Q(rating__gt=3)
    )

    # Query 3: The bestselling books of the author ‘J.K. Rolling’
    
    rolling_bestsellers = Book.objects.filter(
        author='J.K. Rolling',
        is_bestselling=True
    )

    context = {
        'high_rated_books': high_rated_books,
        'potter_books': potter_complex_query,
        'rolling_books': rolling_bestsellers,
    }

    return render(request, 'books/book_list.html', context)