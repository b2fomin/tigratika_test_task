export interface IRowGroupData {
    name: string,
    amount: number,
    source: string,
    lazer: number,
    welding: number,
    electricity: number,
    id?: number
}

export interface IRowSubGroupData {
    name: string,
    amount: number,
    source: string
}