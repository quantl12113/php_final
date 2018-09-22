public class FirstNumberApp {
    public void checkNumber(int number){
        if(NumberUtil.checkSquareNumber(number))
            System.out.println(number+" is square number");
        else
            System.out.println(number+" is not square number");
        NumberUtil.checkPerfectNumber(number);
    }
}
