public class FirstNumberApp {
    public static void checkNumber(int number){
        if(NumberUtil.checkPrimeNumber(number))
            System.out.println(number+" is prime");
        else
            System.out.println(number+" is composite");
    }
}
