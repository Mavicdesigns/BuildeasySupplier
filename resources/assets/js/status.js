/**
 * Created by Anjola on 4/16/2019.
 */
export function status(value){

    value = parseInt(value);

    if(value == 0){
        return "Not Confirmed"
    }else if(value == 1){
        return "Not Paid"
    }else if(value == 2){
        return "Not Fulfilled"
    }else {
        return "Fulfilled"
    }

}