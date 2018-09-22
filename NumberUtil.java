public class NumberUtil {
    public static boolean checkSquareNumber(int num){
        if(num < 0) return false;
        if(Math.sqrt(num) > (int)Math.sqrt(num)) return false;
        else return true;
    }
}
