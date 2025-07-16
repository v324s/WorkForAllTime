#include <stdio.h>
#include <stdlib.h>
#include <string.h>


void main(){
    
    printf("Введите целое число \n");
    char x[60];
    scanf("%s", x);
    int intLen=strlen(x);

    for (int i = 0; i < intLen; i++)
    {
        if (x[i] % 2 !=0){
            printf("Нечетные цифры в числе - %c\n", x[i]);
        }
    }
}






// system("PAUSE");