#include <stdio.h>
#include <stdlib.h>


void main(){
    const int col = 4, 
              row = 6;
    int mat[col][row];
    printf("Создана матрица размером %dx%d:\n", col, row);
    for (int i = 0; i < col; i++)
    {
        printf("#%d - ", i);
        for (int j = 0; j < row; j++)
        {
            mat[i][j]=rand();
            printf("%d      ", mat[i][j]);
        }
        printf("\n");
    }
    int mat_minVarInColumn[col];
    for (int i = 0; i < col; i++)
    {
        for (int j = 0; j < row; j++)
        {
            if (j==0 || mat_minVarInColumn[i]>mat[i][j])
            {
                mat_minVarInColumn[i]=mat[i][j];
            }
            
        }
    }
    printf("Минимальные значения в столбцах:\n");
    for (int i = 0; i < col; i++)
    {
        printf("#%d - %d\n", i, mat_minVarInColumn[i]);
    }
}






// system("PAUSE");