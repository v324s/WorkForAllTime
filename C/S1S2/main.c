#include <stdio.h>

void main(){
    int sum_chet = 0, sum_not_chet = 0;
    for (int i = 0; i <= 100; i++)
    {
        if (i % 2 == 0){
            sum_chet+=i;
        }else{
            sum_not_chet+=i;
        }
    }
    printf("Сумма четных чисел от 0 до 100 = %i \n", sum_chet);
    printf("Сумма нечетных чисел от 0 до 100 = %i \n", sum_not_chet);
}