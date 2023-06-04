export default async function getCurrentUser() {
    
    const url = "../../register-packages/app-pages/userInfo.json";

    const data = await fetch(url
    , { mode:"cors" });

    const user = await data.json();
    return user;
}   