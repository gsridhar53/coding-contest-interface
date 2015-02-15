#include<stdio.h>
int main()
{
    int n,a,b;
//    char *str = "hello" ;
    scanf("%d",&n);

  //  str[1] = 'z' ;
    while(n--)
    {
        scanf("%d%d",&a,&b);
        printf("%d\n",(a + b));
    }
//    printf("\n\n\n\n");
    return 0;
}
