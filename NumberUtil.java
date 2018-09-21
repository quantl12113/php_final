public class NumberUtil {
    static void checkSquareNumber(int number){
    }
    static void checkPerfectNumber(int number){
        int temp = 0;
        for(int i=1;i<=number/2;i++){
            if(number%i == 0){
                temp += i;
            }
        }
        if(temp == number){
            System.out.println("It is a perfect number");
        } else {
            System.out.println("It is not a perfect number");
        }
    }
}
