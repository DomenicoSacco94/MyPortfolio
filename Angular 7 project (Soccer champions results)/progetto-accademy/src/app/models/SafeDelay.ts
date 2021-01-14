export class SafeDelay {
    public static async delay() {
        await new Promise(resolve => setTimeout(()=>resolve(), 500)).then(()=>console.log("fired"));
    }
}