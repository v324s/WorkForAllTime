#include <stdio.h>
#include <stdlib.h>

void main(){
    int arr_size=20;
    int arr[arr_size];
    int count_zero=0;
    printf("Создан массив arr из %d чисел\n", arr_size);
    while (count_zero==0){
        for (int i = 0; i < arr_size; i++)
        {
            arr[i]=rand()%6;
            printf("arr[%d] = %d \n", i, arr[i]);
            if (arr[i]==0)
                count_zero++;
        }
    }
    printf("Необходимо удалить все нулевые элементы\nВ массиве %d нулевых элементов\n", count_zero);
    int new_arr[arr_size-count_zero];
    int k=0;
    printf("Новый массив содержит %d элементов\n", arr_size-count_zero);
    for (int i = 0; i < arr_size; i++)
    {
        if (arr[i]!=0)
        {
            new_arr[k]=arr[i];
            printf("arr[%d] = %d \n", k, new_arr[k]);
            k++;
        }
    }
}






// system("PAUSE");